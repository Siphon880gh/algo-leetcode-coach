## Prefix + suffix merge

1. Grow `l` while sorted; if `l == n − 1`, return 0.
2. Shrink `r` from the end while sorted.
3. `best = min(n − l − 1, r)`; then `i = 0`, `j = r`: while `i ≤ l` and `j < n`: if `arr[i] ≤ arr[j]`, `best = min(best, j − i − 1)`, `i += 1`; else `j += 1`.

`[1,2,3,10,4,2,3,5]` → 3. `[5,4,3,2,1]` → 4. `[1,2,3]` → 0.

Do not only remove the middle unsorted part; the prefix and suffix may also need trimming to connect.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
