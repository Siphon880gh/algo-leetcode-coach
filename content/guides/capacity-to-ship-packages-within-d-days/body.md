## Feasibility is monotonic

`days_needed(cap)`: start a day with load 0; for each weight, if `load + w > cap`, start a new day; add `w`.

`lo = max(weights)` (a package cannot be split), `hi = sum(weights)` (one day). While `lo < hi`:

- `mid = (lo + hi) // 2`.
- If `days_needed(mid) ≤ days`, `hi = mid`; else `lo = mid + 1`.

Return `lo`.

Loading greedily in order is optimal for a fixed capacity: putting a package off to the next day never helps.

Do not start the search at 1; capacities below the heaviest package make `days_needed` meaningless. Do not reorder the packages; they ship in order.

Time: O(n log(sum))  
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
