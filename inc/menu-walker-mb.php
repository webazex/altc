<?php
class True_Walker_Nav_Menu_Mb extends Walker_Nav_Menu {
    /*
     * Позволяет перезаписать <ul class="sub-menu">
     */
    function start_lvl( &$output, $depth = 0, $args = NULL ) {
        // для WordPress 5.3+
        // function start_lvl( &$output, $depth = 0, $args = NULL ) {
        /*
         * $depth – уровень вложенности, например 2,3 и т д
         */
        $output .= '<ul class="sub-menu">';
    }
    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output
     * @param object $item Объект элемента меню, подробнее ниже.
     * @param int $depth Уровень вложенности элемента меню.
     * @param object $args Параметры функции wp_nav_menu
     */
    function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
        // для WordPress 5.3+
        // function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
        global $wp_query;
        /*
         * Некоторые из параметров объекта $item
         * ID - ID самого элемента меню, а не объекта на который он ссылается
         * menu_item_parent - ID родительского элемента меню
         * classes - массив классов элемента меню
         * post_date - дата добавления
         * post_modified - дата последнего изменения
         * post_author - ID пользователя, добавившего этот элемент меню
         * title - заголовок элемента меню
         * url - ссылка
         * attr_title - HTML-атрибут title ссылки
         * xfn - атрибут rel
         * target - атрибут target
         * current - равен 1, если является текущим элементом
         * current_item_ancestor - равен 1, если текущим (открытым на сайте) является вложенный элемент данного
         * current_item_parent - равен 1, если текущим (открытым на сайте) является родительский элемент данного
         * menu_order - порядок в меню
         * object_id - ID объекта меню
         * type - тип объекта меню (таксономия, пост, произвольно)
         * object - какая это таксономия / какой тип поста (page /category / post_tag и т д)
         * type_label - название данного типа с локализацией (Рубрика, Страница)
         * post_parent - ID родительского поста / категории
         * post_title - заголовок, который был у поста, когда он был добавлен в меню
         * post_name - ярлык, который был у поста при его добавлении в меню
         */
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        /*
         * Генерируем строку с CSS-классами элемента меню
         */
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // функция join превращает массив в строку
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        /*
         * Генерируем ID элемента
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        /*
         * Генерируем элемент меню
         */
        $output .= $indent . '<li' . $id . $value . $class_names .'>';


        $has_children = false;
        $item_classes = (array)$item->classes;
        foreach ($item_classes as $class_item){
            if ($class_item == 'menu-item-has-children') $has_children = true;
        }



        // атрибуты элемента, title="", rel="", target="" и href=""
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        // ссылка и околоссылочный текст
        $item_output = $args->before;

        //if ($has_children){
        //    $item_output .= '<span class="menu-item-has-children-wrap" style="display: flex; gap: 10px; align-items: center;">';
        //}





        $item_output .= '<a'. $attributes .'>';





        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

        if ($has_children){
            $item_output .= '<span class="toggle">
<svg class="sub-hide-icon" width="52" height="37" viewBox="0 0 52 37" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.5" d="M4.88625 36.412V0.987999H11.2063V3.58H7.47825V33.82H11.2063V36.412H4.88625Z" fill="#fe0000"/>
<path d="M20 12L32 24" stroke="#fe0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M22.25 24H32V14.25" stroke="#fe0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path opacity="0.5" d="M47.1137 36.412V0.987999H40.7937V3.58H44.5217V33.82H40.7937V36.412H47.1137Z" fill="#fe0000"/>
</svg>
<svg class="sub-show-icon" width="52" height="37" viewBox="0 0 52 37" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.5" d="M4.88625 36.412V0.987999H11.2063V3.58H7.47825V33.82H11.2063V36.412H4.88625Z" fill="#FEFEFE"/>
<path d="M20 24L32 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M22.25 12H32V21.75" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path opacity="0.5" d="M47.1137 36.412V0.987999H40.7937V3.58H44.5217V33.82H40.7937V36.412H47.1137Z" fill="white"/>
</svg>


         </span>';
        }






        $item_output .= '</a>';



       // if ($has_children){
        //    $item_output .= '<span class="menu-item-has-children-toggle"></span>';
       // }


      //  if ($has_children){
      //      $item_output .= '</span>';
      //  }


        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}