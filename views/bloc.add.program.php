<section id="">
	<article>
		<h2>Chargez le programme du <?php echo $bloc_selected;?></h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc&amp;see=addsingleprogram" method="post">
			<p>Sélectionnez le fichier</p>
			<input type="file" name="bloc_file" />
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<p>	<input type="submit" name="bloc_import" value="Importer"> </p>
		</form>
	</article>
</section>