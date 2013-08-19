<?php
  /**
   *  @author  Opeykin A. <http://andrey.opeykin.ru> <developer@allframeworks.ru>
   *  @version 0.0.2
   *  @package filters
   *
   *  Фильтр предназначен для фильтрации входных данных, c целью предотвратить xss атаки.
   *  Для фильтрации используются регулярные выражения из фреймворка Kohana версии 2.3.4
   *
   *  @example
   *
   *  public function filters()
   *  {
   *         return array(
   *                 array(
   *                       'application.filters.XssFilter',
   *                       'clean'   => '*',
   *                       'tags'    => 'strict',
   *                       'actions' => 'all'
   *                 )
   *         );
   *
   *   }
   *
   *   Описание параметров
   *
   *   В качетве параметра 'clean' могут быть:
   *  - 'all' - фильтруются GET,POST,COOKIE,FILES массивы;
   *  - '*'   - аналог ALL;
   *  - так же возможно сочетание любых из параметров, например GET,COOKIE или POST,FILES
   *   В качестве параметра 'tags' могут быть:
   *  - 'strict' - ко всем параметрам применяется функция strip_tags (используется по умолчанию)
   *  - 'soft'   - ко всем параметрам применяется функция htmlspecialchars
   *  - 'none'   - не фильтровать
   *   В качестве параметра 'actions' могут быть:
   *  - '*' или 'all' - фильтруются все экшены
   *  - можно указать экшены через запятую, пример
   *   'actions' => 'admin,manage' - фильтровать только экшены admin и manage
   */

class SendViews extends CFilter
{
        public  $actions = '*,all';
        protected function preFilter($filterChain)
        {
                $this->actions = trim(strtoupper($this->actions));
                // если экшн обрабатывать нет необходимости - просто выходим из фильтра
                if($this->actions != '*' && $this->actions != 'ALL' && !in_array($filterChain->action->id,explode(',',$this->actions)))
                {
                    return true;
                }

              return true;
        }
}
?>
