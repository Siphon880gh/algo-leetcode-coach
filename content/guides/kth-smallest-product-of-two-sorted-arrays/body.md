## Count products ≤ x

1. `lo = −10^10`, `hi = 10^10`.
2. `count(x)`: for each `a`: `a > 0` → `bisect_right(b, floor(x / a))`; `a < 0` → `len(b) − bisect_left(b, ceil(x / a))`; `a == 0` → `len(b)` if `x ≥ 0` else 0.
3. While `lo < hi`: `mid = ⌊(lo + hi) / 2⌋`; if `count(mid) ≥ k`, `hi = mid`, else `lo = mid + 1`.

Examples → 8, 0, −6. Checked against sorting all products on random arrays.

Dividing by a negative `a` flips the inequality, which is the usual bug; use floor and ceiling division that are exact for negatives. A two-pointer count per sign group makes each count O(n + m).

Time: O(n log m · log 10^10)  
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
