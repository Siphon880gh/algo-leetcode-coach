## Edge analysis

1. `base = Σ |a[i] − a[i + 1]|`.
2. Prefix or suffix: for each `i`, `|a[0] − a[i + 1]| − |a[i] − a[i + 1]|` and `|a[n − 1] − a[i]| − |a[i] − a[i + 1]|`.
3. Interior: `hi = max(min(a[i], a[i + 1]))`, `lo = min(max(a[i], a[i + 1]))`; gain `2 · (hi − lo)`.
4. Return `base + max(0, best gain)`.

`[2,3,1,5,4]` → 10. `[2,4,9,24,2,1,10]` → 68.

Do not try every subarray; that is O(n²) or worse. Do not forget the prefix and suffix cases; the interior formula assumes two changed edges.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
