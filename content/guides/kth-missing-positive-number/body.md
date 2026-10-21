## Missing-count function

1. `missing(i) = arr[i] − i − 1` (non-decreasing).
2. Find the smallest `lo` with `missing(lo) ≥ k` (or `lo = n`).
3. Return `lo + k`.

`[2,3,4,7,11]`, k = 5 → 9. `[1,2,3,4]`, k = 2 → 6.

Do not forget the case where all missing numbers lie past the end (lo = n). A linear scan also passes for n ≤ 1000.

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
