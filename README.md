


Go to iomad root folder and do:

```
find ./ -iwholename "*en/*iomad*.php" -exec cp --parents \{\} ../iomad-traducao/src/ \;
find ./ -iwholename "*en/local_report_*.php" -exec cp --parents \{\} ../iomad-traducao/src/ \;
find ./ -iwholename "*en/block_mycourses.php"  -exec cp --parents \{\} ../iomad-traducao/src/ \;
```

to copy the src folder

Other courses to translate:

local/report_*
blocks/mycourses


Translate in google docs

