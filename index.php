<?php

require_once 'core/init.php';


Helper::getHeader('Algebra Contacts', 'main-header');

?>

    <div class="row">
		<div class="col-xs-12 col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
			<div class="jumbotron">
				<div class="container">
					<h1><?php echo Config::get('app')['name'] ?></h1>
					<p>Sed at purus condimentum, dictum lacus vel, convallis metus. Phasellus lacinia, sem sed tincidunt suscipit, velit lectus placerat urna, id accumsan ante nisi ut metus. Ut a justo sed nibh egestas pellentesque. Aenean tempor, sapien vel egestas bibendum, dolor dolor pulvinar leo, et euismod mauris purus nec augue. Integer vulputate vitae urna vitae porta. Morbi semper purus purus, vitae ultricies lectus consectetur eget. In turpis eros, sollicitudin sed tincidunt a, auctor vitae ex. Integer accumsan lacus ac erat pretium scelerisque. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
					<p>
						<a class="btn btn-primary btn-lg" href="login.php" role="button">Sign In</a>
						or
						<a class="btn btn-primary btn-lg" href="register.php" role="button">Create an account</a> 
					</p>
				</div>
			</div>
		</div>
	</div>

<?php

$db = DB::getInstance();

$get = $db->get('*','users');

//$find = $db->find(5, 'users');
//$delete = $db->delete('users', ['id', '=', 4]);

$update = $db->update('users', 5,[
	'username' 	=> 'markina',
	'name' 		=> 'Ivan'
]);

/* $insert = $db->insert('users',[
	'name'		=> 'Iva',
	'username'	=> 'iiva',
	'password'	=> 'q12432df543',
	'salt'		=> '5468354',
	'role_id'	=> '1'
]); */


echo '<pre>';
var_dump($update);


Helper::getFooter();

?>