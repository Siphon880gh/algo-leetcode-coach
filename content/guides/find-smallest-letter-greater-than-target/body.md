## bisect_right

`lo = 0`, `hi = n`. While `lo < hi`: `mid = (lo + hi) // 2`; if `letters[mid] ≤ target`, `lo = mid + 1`, else `hi = mid`.

Return `letters[lo % n]`. When `lo == n`, nothing is greater, and the problem wraps to `letters[0]`.

The array may contain duplicates; the `≤` comparison skips past all copies equal to the target.

Do not use `<`; that finds the first letter `≥ target`, which can equal it. Do not scan linearly unless the input is tiny; the sorted order is there to use.

Time: O(log n)  
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
