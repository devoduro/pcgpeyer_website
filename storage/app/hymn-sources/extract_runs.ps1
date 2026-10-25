# Extracts text (with the font of each run) from the hymn slides, read-only.
$d = "C:\Users\G7\OneDrive\Desktop\GA-TWI-ENG HYMNS"
$out = "C:\Users\G7\dev\hymns\hymns_runs.json"
$ppt = New-Object -ComObject PowerPoint.Application
$all = New-Object System.Collections.ArrayList
foreach ($f in (Get-ChildItem $d -Filter *.ppt)) {
  try {
    $p = $ppt.Presentations.Open($f.FullName, -1, 0, 0)
    $slides = New-Object System.Collections.ArrayList
    $i = 0
    foreach ($s in $p.Slides) {
      $i++
      $shapes = New-Object System.Collections.ArrayList
      foreach ($sh in $s.Shapes) {
        if ($sh.HasTextFrame -and $sh.TextFrame.HasText) {
          $runs = New-Object System.Collections.ArrayList
          foreach ($r in $sh.TextFrame.TextRange.Runs()) { [void]$runs.Add(@{ font = $r.Font.Name; text = $r.Text }) }
          [void]$shapes.Add(@{ left = [int]$sh.Left; top = [int]$sh.Top; runs = $runs })
        }
      }
      [void]$slides.Add(@{ n = $i; shapes = $shapes })
    }
    $p.Close()
    [void]$all.Add(@{ file = $f.Name; slides = $slides })
  } catch { [void]$all.Add(@{ file = $f.Name; error = $_.Exception.Message }) }
}
$ppt.Quit()
$all | ConvertTo-Json -Depth 8 | Out-File $out -Encoding utf8
"done $($all.Count)"
