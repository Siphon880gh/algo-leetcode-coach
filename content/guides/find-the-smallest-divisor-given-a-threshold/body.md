## Search on the answer

1. `lo = 1`, `hi = max(nums)`.
2. While `lo < hi`: `mid = (lo + hi) / 2`; if `Σ ceil(x / mid) ≤ threshold`, `hi = mid`, else `lo = mid + 1`.
3. Return `lo`.

Use `(x + d − 1) / d` for the ceiling.

`[1,2,5,9]`, threshold 6 → 5. `[44,22,33,11,1]`, threshold 5 → 44.

Do not use floor division; each element rounds up. Do not search past `max(nums)`; at that divisor every term is 1 already.

Time: O(n log max)  
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
