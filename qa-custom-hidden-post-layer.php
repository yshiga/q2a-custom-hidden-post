<?php

class qa_html_theme_layer extends qa_html_theme_base {

	public function c_list_item($c_item)
	{
		$extraclass = @$c_item['classes'].(@$c_item['hidden'] ? ' qa-c-item-hidden' : '');

		$this->output('<div class="qa-c-list-item '.$extraclass.'" '.@$c_item['tags'].'>');

		// コメントが非表示でない、または、ログインしていて権限がモデレータ以上
		// の場合は今までどおり
		if (!@$c_item['hidden'] ||
			(qa_is_logged_in() &&
			qa_get_logged_in_level() >= QA_USER_LEVEL_MODERATOR)) {
			qa_html_theme_base::c_item_main($c_item);
		} else {
			$this->c_item_main($c_item);
		}
		$this->c_item_clear();

		$this->output('</div> <!-- END qa-c-item -->');
	}

	public function c_item_main($c_item)
	{
		$this->error(@$c_item['error']);

		$this->output('<div class="qa-c-item-footer">');
		$this->post_avatar_meta_custom($c_item, 'qa-c-item');
		$this->c_item_buttons($c_item);
		$this->output('</div>');
	}

	public function post_avatar_meta_custom($post, $class, $avatarprefix=null, $metaprefix=null, $metaseparator='<br/>')
	{
		$this->output('<span class="'.$class.'-avatar-meta">');
		$this->avatar($post, $class, $avatarprefix);
		$this->post_meta_custom($post, $class, $metaprefix, $metaseparator);
		$this->output('</span>');
	}

	public function post_meta_custom($post, $class, $metaprefix, $metaseparator)
	{
		$this->output('<span class="'.$class.'-meta">');

		if (isset($prefix))
			$this->output($prefix);

		$order = explode('^', @$post['meta_order']);

		$this->post_meta_flags($post, $class);

		if (!empty($post['what_2'])) {
			$this->output($separator);

			foreach ($order as $element) {
				switch ($element) {
					case 'what':
						$this->output('<span class="'.$class.'-what">'.$post['what_2'].'</span>');
						break;

					case 'when':
						$this->output_split(@$post['when_2'], $class.'-when');
						break;

					case 'who':
						$this->output_split(@$post['who_2'], $class.'-who');
						break;
				}
			}
		}

		$this->output('</span>');
	}

	public function a_item_main($a_item)
	{
		$this->output('<div class="qa-a-item-main">');

		if (isset($a_item['main_form_tags']))
			$this->output('<form '.$a_item['main_form_tags'].'>'); // form for buttons on answer

		if ($a_item['hidden'])
			$this->output('<div class="qa-a-item-hidden">');
		elseif ($a_item['selected'])
			$this->output('<div class="qa-a-item-selected">');

		$this->a_selection($a_item);
		$this->error(@$a_item['error']);
		// 回答が非表示でない、または、ログインしていて権限がモデレータ以上
		// の場合は今までどおりa_item_content(本文)を表示
		if (!@$a_item['hidden'] ||
			(qa_is_logged_in() &&
			qa_get_logged_in_level() >= QA_USER_LEVEL_MODERATOR)) {
			$this->a_item_content($a_item);
		} else {
			// ここのボタンはいらないので削除
			unset($a_item['form']);
		}
		$this->post_avatar_meta($a_item, 'qa-a-item');

		if ($a_item['hidden'] || $a_item['selected'])
			$this->output('</div>');

		$this->a_item_buttons($a_item);

		$this->c_list(@$a_item['c_list'], 'qa-a-item');

		if (isset($a_item['main_form_tags'])) {
			$this->form_hidden_elements(@$a_item['buttons_form_hidden']);
			$this->output('</form>');
		}

		$this->c_form(@$a_item['c_form']);

		$this->output('</div> <!-- END qa-a-item-main -->');
	}

}
