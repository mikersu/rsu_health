<?php  

class Pagination_over
{
	// Default values
	var $items = -1;
	var $limit = NULL;
	var $target = "";
	var $page = 1;
	var $adjacents = 1;
	var $showCounter = FALSE;
	var $className = "pagination";
	var $parameterName = "page";
	
	// urlFriendly
	var $urlF = FALSE;
	var $rebuildQuery = TRUE;
	var $allowedParams = array();
	
	// Buttons next and previous
	var $nextT = "Next";
	var $nextI = "&#187;"; //&#9658;
	var $prevT = "Previous";
	var $prevI = "&#171;"; //&#9668;

	var $tag = 'span';
	var $tag_main = 'div';
	var $tag_current = 'span';
	var $tag_list = 'span';
	var $tag_next = 'span';
	var $tag_next_disabled = 'span';
	var $tag_prev = 'span';
	var $tag_prev_disabled = 'span';
	var $pagination;
	var $calculate = FALSE;
	var $show_sn = FALSE;
	var $space_empty = '...';
	
	// -------------------------------------------------------------------------
	
	/**
	 * Constructor
	 * 
	 */
	public function __construct($params = array())
	{
		// initialize with parameters
		if (is_array($params) OR is_object($params))
		{
			foreach ($params as $name => $value)
			{
				if (property_exists($this, $name))
				{
					$this->{$name} = $value;
				}
			}
		}
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Helper Method - Calculate page offset
	 * 
	 * @param	Integer	$page	current page
	 * @param	Integer	$limit	Limit result per page
	 * @return	Integer			offset to use for sql
	 */
	static function page_offset($page, $limit)
	{
		$page = $page ? (int) $page : 1 ;
		return ($page - 1) * $limit;
	}
	
	public function offset()
	{
		return self::page_offset($this->page, $this->limit);
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Set total items
	 * 
	 * @param	Integer	$value	total number of items
	 */
	public function items($value)
	{
		$this->items = (int) $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Items to show per page
	 * 
	 * @param	Integer	$value	result per page
	 */
	public function limit($value)
	{
		$this->limit = (int) $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Page to sent the page value
	 * 
	 * @param	String	$value	base link target
	 */
	public function target($link_target)
	{
		$this->target = $link_target;
		
		if ( ! $this->rebuildQuery)
		{
			return;
		}
		
		// rebuild GET query
		$query = $this->_rebuild_query();
		
		// only append query when has parameter to append
		if ( ! empty($query))
		{
			$this->target .= '?' . $query;
		}
		
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Set current page
	 * 
	 * @param	Integer	$value	current page
	 */
	public function currentPage($value)
	{
		$this->page = (int) $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * How many adjacent pages should be shown on each side of the current page?
	 * 
	 * @param	Integer	$value	number of adjacent pages to show
	 */
	public function adjacents($value)
	{
		$this->adjacents = (int) $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * show counter?
	 * 
	 * @param	Boolean	$value	show counter?
	 */
	public function showCounter($value = "")
	{
		$this->showCounter = ($value === TRUE) ? TRUE: FALSE;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * change the class name of the pagination div
	 * 
	 * @param	String	$value	you desired class name
	 */
	public function changeClass($value = "")
	{
		$this->className = $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Label of the "Next" link
	 * 
	 * @param	String	$value	"next" text
	 */
	public function nextLabel($value)
	{
		$this->nextT = $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Icon entity of the "Next" link
	 * 
	 * @param	String	$value	html entity code
	 */
	public function nextIcon($value)
	{
		$this->nextI = $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Label of the "Prev" link
	 * 
	 * @param	String	$value	Label of the "Prev" link
	 */
	public function prevLabel($value)
	{
		$this->prevT = $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Icon entity of the "Prev" link
	 * 
	 * @param	String	$value	html entiry code to use as Prev Icon
	 */
	public function prevIcon($value)
	{
		$this->prevI = $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Change the parameter name if the page param
	 * 
	 * @param	String	$value	Name of parameter
	 */
	public function parameterName($value = "")
	{
		$this->parameterName = $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Set charactor token to use as url mask
	 * 
	 * @param	String	$value	token string default is %
	 */
	public function urlFriendly($value = "%")
	{
		if (preg_match('~^ *$~i', $value))
		{
			$this->urlF = FALSE;
			return FALSE;
		}
		
		$this->urlF = $value;
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Display the pagination
	 * 
	 */
	public function show()
	{
		if ( ! $this->calculate)
		{
			if ($this->calculate())
			{
				echo "<{$this->tag_main} class=\"{$this->className}\">{$this->pagination}</{$this->tag_main}>\n";
			}
		}
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Fetch the pagination output
	 * 
	 */
	public function getOutput()
	{
		if ( ! $this->calculate )
		{
			if ($this->calculate())
			{
				return "<{$this->tag_main} class=\"{$this->className}\">{$this->pagination}</{$this->tag_main}>\n";
			}
		}
	}

	// -------------------------------------------------------------------------
	
	/**
	 * Rebuild HTTP query string
	 * This method will generate a query string from $_GET array
	 * note that only allowed parameter in $this->allowedParams array will be processed
	 * 
	 * @return	String		query string
	 */
	protected function _rebuild_query()
	{
		$params = $_GET;
		
		foreach ($params as $name => $value)
		{
			// on allowed params will be set, and $this->parameterName will be forced to be deleted
			if (( ! empty($this->allowedParams) AND ! in_array($name, $this->allowedParams)) OR $name == $this->parameterName)
			{
				unset($params[$name]);
			}
		}
		
		if ( ! count($params))
		{
			return '';
		}
		
		return http_build_query($params);
	}	
	
	// -------------------------------------------------------------------------
	
	/**
	 * Helper function to generate a link
	 * 
	 * @param	Integer	$id	number of page
	 * @return	String		full request url
	 */
	function get_pagenum_link($id)
	{
		if (strpos($this->target, '?') === FALSE)
		{
			if ($this->urlF)
			{
				return str_replace($this->urlF, $id, $this->target);
			}
			else
			{
				return "{$this->target}?{$this->parameterName}={$id}";
			}
		}
		else
		{
			return "{$this->target}&{$this->parameterName}={$id}";
		}
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Magic method quickly return output of pagination
	 * 
	 * @return	String		pagination output
	 */
	function __toString()
	{
		return $this->getOutput();
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Main process , gathering all data then generate pagination output
	 * 
	 * @return	String		pagination output
	 */
	protected function calculate()
	{
		$this->pagination = "";
		$this->calculate == TRUE;
		$error = FALSE;
		
		if ($this->urlF AND $this->urlF != '%' AND strpos($this->target, $this->urlF) === FALSE)
		{
			//Es necesario especificar el comodin para sustituir
			echo "Especificaste un wildcard para sustituir, pero no existe en el target<br />";
			$error = TRUE;
		}
		elseif ($this->urlF AND $this->urlF == '%' AND strpos($this->target, $this->urlF) === FALSE)
		{
			echo "Es necesario especificar en el target el comodin % para sustituir el número de página<br />";
			$error = TRUE;
		}
		
		if ($this->items < 0)
		{
			echo "It is necessary to specify the <strong>number of pages</strong> (\$class->items(1000))<br />";
			$error = TRUE;
		}
		
		if ($this->limit == NULL)
		{
			echo "It is necessary to specify the <strong>limit of items</strong> to show per page (\$class->limit(10))<br />";
			$error = TRUE;
		}
		
		if ($error)
		{
			return FALSE;
		}
		
		$n = trim($this->nextT . ' ' . $this->nextI);
		$p = trim($this->prevI . ' ' . $this->prevT);
		
		/* Setup vars for query. */
		if($this->page)
		{
			$start = ($this->page - 1) * $this->limit;             //first item to display on this page
		}
		else
		{
			$start = 0;                                //if no page var is given, set start to 0
		}
		
		// -------------------------------------------------------------------------
		// Setup page vars for display.
		
		//previous page is page - 1
		$prev = $this->page - 1;
		
		//next page is page + 1
		$next = $this->page + 1;
		
		//lastpage is = total pages / items per page, rounded up.
		$lastpage = ceil($this->items/$this->limit);
		
		//last page minus 1
		$lpm1 = $lastpage - 1;                        
		
		// -------------------------------------------------------------------------
		// Now we apply our rules and draw the pagination object.
		// We're actually saving the code to a variable in case we want to draw it more than once.
		
		if ($lastpage > 1)
		{
			if ($this->page)
			{
				//anterior button
				if ($this->page > 1)
				{
					$this->pagination .= "<{$this->tag_prev}><a href=\"" . $this->get_pagenum_link($prev) . "\" class=\"prev\">{$p}</a></{$this->tag_prev}>";
				}
				else if ( $this->show_sn )
				{
					$this->pagination .= "<{$this->tag_prev_disabled}><span class=\"disabled\">{$p}</span></{$this->tag_prev_disabled}>";
				}
			}
			
			// -------------------------------------------------------------------------
			// pages
			
			// not enough pages to bother breaking it up
			if ($lastpage < 7 + ($this->adjacents * 2))
			{
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $this->page)
					{
						$this->pagination .= "<{$this->tag_current} class=\"current\"><span class=\"current\" >{$counter}</span></{$this->tag_current}>";
					}
					else
					{
						$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($counter) . "\">{$counter}</a></{$this->tag_list}>";
					}
				}
			}
			
			// enough pages to hide some
			elseif ($lastpage > 5 + ($this->adjacents * 2))
			{
				// close to beginning; only hide later pages
				if($this->page < 2 + ($this->adjacents * 2))
				{
					for ($counter = 1; $counter < 4 + ($this->adjacents * 2); $counter++)
					{
						if ($counter == $this->page)
						{
							$this->pagination .= "<{$this->tag_current} class=\"current\"><span class=\"current\" >{$counter}</span></{$this->tag_current}>";
						}
						else
						{
							$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($counter) . "\">{$counter}</a></{$this->tag_list}>";
						}
					}
					
					$this->pagination .= $this->space_empty;
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($lpm1) . "\">$lpm1</a></{$this->tag_list}>";
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($lastpage) . "\">$lastpage</a></{$this->tag_list}>";
				}
				
				// in middle; hide some front and some back
				elseif ($lastpage - ($this->adjacents * 2) > $this->page AND $this->page > ($this->adjacents * 2))
				{
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link(1) . "\">1</a></{$this->tag_list}>";
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link(2) . "\">2</a></{$this->tag_list}>";
					$this->pagination .= $this->space_empty;
					
					for ($counter = $this->page - $this->adjacents; $counter <= $this->page + $this->adjacents; $counter++)
					{
						if ($counter == $this->page)
						{
							$this->pagination .= "<{$this->tag_current} class=\"current\"><span class=\"current\" >{$counter}</span></{$this->tag_current}>";
						}
						else
						{
							$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($counter) . "\">{$counter}</a></{$this->tag_list}>";
						}
					}
					
					$this->pagination .= $this->space_empty;
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($lpm1) . "\">{$lpm1}</a></{$this->tag_list}>";
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($lastpage) . "\">{$lastpage}</a></{$this->tag_list}>";
				}
				
				// close to end; only hide early pages
				else
				{
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link(1) . "\">1</a></{$this->tag_list}>";
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link(2) . "\">2</a></{$this->tag_list}>";
					$this->pagination .= $this->space_empty;
					
					for ($counter = $lastpage - (2 + ($this->adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $this->page)
						{
							$this->pagination .= "<{$this->tag_current} class=\"current\"><span class=\"current\" >{$counter}</span></{$this->tag_current}>";
						}
						else
						{
							$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($counter) . "\">{$counter}</a></{$this->tag_list}>";
						}
					}
				}
			}
			
			if ($this->page)
			{
				// siguiente button
				if ($this->page < $counter - 1)
				{
					$this->pagination .= "<{$this->tag_list}><a href=\"" . $this->get_pagenum_link($next) . "\" class=\"next\">{$n}</a></{$this->tag_list}>";
				}
				else
				{
					if ( $this->show_sn ) 
					{
						$this->pagination .= "<{$this->tag_next_disabled}><span class=\"disabled\">$n</span></{$this->tag_next_disabled}>";
					}
					
					if ($this->showCounter)
					{
						$this->pagination .= "<div class=\"pagination_data\">({$this->items} Pages)</div>";
					}
				}
			}
		}
		
		return true;
	}
}
