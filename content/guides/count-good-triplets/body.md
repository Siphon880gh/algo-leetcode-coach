## Triple loop

1. For `i < j`: if `|arr[i] − arr[j]| > a`, continue.
2. For `k > j`: count when `|arr[j] − arr[k]| ≤ b` and `|arr[i] − arr[k]| ≤ c`.

`[3,0,1,1,9,7]`, a = 7, b = 2, c = 3 → 4. `[1,1,2,2,3]`, 0, 0, 1 → 0.

Do not drop the index order; triplets need i < j < k. Prefix counts over values give O(n² + n·V) if needed.

Time: O(n³)  
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
