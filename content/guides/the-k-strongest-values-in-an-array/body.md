## Ends are strongest

1. Sort; `m = arr[(n − 1) // 2]`.
2. `l = 0`, `r = n − 1`. Repeat k times: if `|arr[r] − m| ≥ |arr[l] − m|`, take `arr[r]` and `r −= 1`; else take `arr[l]` and `l += 1`.

`[1,2,3,4,5]`, k = 2 → `[5,1]`. `[1,1,3,5,5]`, k = 2 → `[5,5]`. `[6,7,11,7,6,8]`, k = 5 → e.g. `[11,8,6,6,7]`.

Do not use the mean or the upper median; the statement defines m as the lower middle element. Ties favour the larger value, which is the right pointer.

Time: O(n log n)  
Space: O(1) extra

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
