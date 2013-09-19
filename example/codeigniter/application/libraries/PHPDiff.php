<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class PHPDiff
 */
class PHPDiff
{
  private $phpdiff;

  /**
   *
   */
  public function __construct()
  {
    // load our main library and "renderers"
    require_once BASEPATH . '../../vendor/reactordrop/php-diff/lib/Diff/SequenceMatcher.php';
    require_once BASEPATH . '../../vendor/reactordrop/php-diff/lib/Diff/Diff.php';
    require_once BASEPATH . '../../vendor/reactordrop/php-diff/lib/Diff/Renderer/Abstract.php';
    require_once BASEPATH . '../../vendor/reactordrop/php-diff/lib/Diff/Renderer/Html/Array.php';
    require_once BASEPATH . '../../vendor/reactordrop/php-diff/lib/Diff/Renderer/Html/SideBySide.php';
    require_once BASEPATH . '../../vendor/reactordrop/php-diff/lib/Diff/Renderer/Html/Inline.php';
    require_once BASEPATH . '../../vendor/reactordrop/php-diff/lib/Diff/Renderer/Text/Unified.php';
    require_once BASEPATH . '../../vendor/reactordrop/php-diff/lib/Diff/Renderer/Text/Context.php';
  }

  /**
   * @param       $strA
   * @param       $strB
   * @param array $arrOptions
   */
  public function Diff($strA, $strB, $arrOptions = array())
  {
    // new diff
    $this->phpdiff = new Diff(explode("\n", $strA), explode("\n", $strB), $arrOptions);
  }

  /**
   * @param $strType
   * @return bool
   */
  public function &Render($strType)
  {
    switch($strType)
    {
      case 'side-by-side':
        $objRenderer = new Diff_Renderer_Html_SideBySide;
        $strResult = $this->phpdiff->render($objRenderer);
        break;
      case 'inline':
        $objRenderer = new Diff_Renderer_Html_Inline;
        $strResult = $this->phpdiff->render($objRenderer);
        break;
      case 'unified':
        $objRenderer = new Diff_Renderer_Text_Unified;
        $strResult = $this->phpdiff->render($objRenderer);
        break;
      case 'context':
        $objRenderer = new  Diff_Renderer_Text_Context;
        $strResult = $this->phpdiff->render($objRenderer);
        break;
      default:
        $strResult = null;
      break;
    }

    return $strResult;
  }
}