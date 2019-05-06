<?php
session_start();

include ("auth.php");
	
	

echo '
											<label for="press'.$data[T_TOPICS_ID].'"><img src="images/arrowdown.jpg" width="12px" /></label>
												<div class="spoiler">
													<input type="checkbox" id="press'.$data[T_TOPICS_ID].'" style="display: none;">
													<div class="block">
														<span class="moder_text">
																	<ul class="boxshow" align="left" >
																		<li>IP : '.$data[T_TOPICS_IP].' </li>
																		<li><a href="">Редактировать</a></li>
																		<li><a href="">Удалить</a></li>
																		<li><a href="">Бан</a></li>
																	</ul>
																</span>
													</div>
												</div>
												';
										
	
?>