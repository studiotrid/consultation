<?php
function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'1\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function SEO_input($value, $fieldname, $primary_key, $list, $xcrud)
{
   return '<div class="input-prepend input-append">' 
        . '<span class="add-on">http://'.$_SERVER['HTTP_HOST'].BASEPATH.'</span>'
        . '<input type="text" id="SEO" name="'.$fieldname.'" value="'.$value.'" class="xcrud-input" style="width:100px !important;position:relative;top:-1px;" />'
        . '</div>';
}

function hash_password($postdata) {
    $postdata->set('password', md5($postdata->get('password').'OvoJeSo'));
    return $postdata;
}

function hash_password_update($postdata, $primary, $xcrud) {
    $postdata->set('password', md5($postdata->get('password').'OvoJeSo'));
    return $postdata;
}

function hash_password2($postdata) {
    $postdata->set('password', md5($postdata->get('password')));
    return $postdata;
}

function hash_password_update2($postdata, $primary, $xcrud) {
   // $primary = (int)$xcrud->get('primary');
    $db = Xcrud_db::get_instance();
    $query = 'SELECT `password` FROM `zaposleni` where id="'.$primary.'" limit 1';
    $db->query($query);
    $result = $db->result();
  foreach ($result as $key => $item){
    if($item['password']!=$postdata->get('password'))
        $postdata->set('password', md5($postdata->get('password')));
    }
    return $postdata;
}

function hash_api_password($postdata) {
    $postdata->set('pass', md5($postdata->get('pass')));
    return $postdata;
}

function hash_api_password_update($postdata, $primary, $xcrud) {
    $postdata->set('pass', md5($postdata->get('pass')));
    return $postdata;
}

function unpublish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function hashLink($postdata){
    $postdata->set('link', base64_encode($postdata->get('kod')));
    return $postdata;
}


function exception_example($postdata, $primary, $xcrud)
{
    $xcrud->set_exception('ban_reason', 'Lol!', 'error');
    $postdata->set('ban_reason', 'lalala');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload')
    {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}

function date_example($postdata, $primary, $xcrud)
{
    $created = $postdata->get('datetime')->as_datetime();
    $postdata->set('datetime', $created);
}

function moveSlidersUp($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `slider_items` ORDER BY `orderno`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `slider_items` SET `orderno` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}
function moveSlidersBottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `slider_items` ORDER BY `orderno`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `slider_items` SET `orderno` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}



function moveImageUp($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `featured_images` GROUP by page,post ORDER BY `redosled`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `featured_images` SET `redosled` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}
function moveImageBottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `featured_images` GROUP by page,post  ORDER BY `redosled`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `featured_images` SET `redosled` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}


function moveNajavaUp($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `najave` GROUP by tip ORDER BY `redosled`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `najave` SET `redosled` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}
function moveNajavaBottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `najave` GROUP by tip  ORDER BY `redosled`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `najave` SET `redosled` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}

function moveGalleryUp($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `gallery_items` ORDER BY gallery,`orderno`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `gallery_items` SET `orderno` = ' . $key . ' WHERE id = ' . $item['id'];
            
            $db->query($query);
        }
      //  echo "<script>console.log('$result');</script>";
    }
}
function moveGalleryBottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `gallery_items` ORDER BY gallery,`orderno`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `gallery_items` SET `orderno` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}
function novi_broj($matches) {
            $broj= ++$matches[1];
            while(strlen($broj)<=7) $broj = '0'.$broj;
            return $broj;
        }
        
function makeSuccess($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        
        $stari_broj = "SELECT broj from polise where broj !='' and `status`='paid' order by broj desc limit 1";
        $db->query($stari_broj);
        $result = $db->result();
        foreach ($result as $key => $item)
            {
            $new=$item['broj'];
            }
        $noviBroj =  preg_replace_callback( "|(\d+)|", "novi_broj", $new);
        

        $query = 'UPDATE `polise` set  status="paid",response="100-OK",AuthCode="MANUAL",HostRefNum="123",ProcReturnCode="123",broj="'.$noviBroj.'"  where id="'.$primary.'"';
        $db->query($query);
        
    }
}



