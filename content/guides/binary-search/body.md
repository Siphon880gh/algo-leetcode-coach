## Closed interval template

`lo = 0`, `hi = n − 1`. While `lo ≤ hi`:

- `mid = lo + (hi − lo) // 2`.
- `nums[mid] == target` → return `mid`.
- `nums[mid] < target` → `lo = mid + 1`.
- Otherwise → `hi = mid − 1`.

Return `-1`.

Pick one convention and keep it consistent: with a closed range, the loop condition is `lo ≤ hi` and both updates skip `mid`. With a half-open range `[lo, hi)`, use `lo < hi` and `hi = mid`.

Do not write `hi = mid` with `lo ≤ hi`; that can loop forever. `(lo + hi) // 2` can overflow in fixed-width languages, which is why the template uses `lo + (hi − lo) // 2`.

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
