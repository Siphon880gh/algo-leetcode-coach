## Skip the repeats

`next(cells)`: cell `i` (1 to 6) becomes 1 if `cells[i − 1] == cells[i + 1]`; cells 0 and 7 become 0.

1. `seen = {}`, `jumped = false`. While `n > 0`:
   - If not `jumped` and `cells` is in `seen`: the cycle length is `seen[cells] − n`; set `n %= length`, `jumped = true`; if `n == 0`, stop.
   - Record `seen[cells] = n`.
   - `cells = next(cells)`, `n −= 1`.
2. Return `cells`.

A shortcut that works for this rule: after day 1 the period divides 14, so `n = (n − 1) % 14 + 1` then simulate.

Do not simulate 10⁹ days directly. Do not use `n % 14`; day 0 can have 1s at the ends and is not on the cycle, which is why the shortcut keeps `n ≥ 1`.

Time: O(2⁶ · 8) at most  
Space: O(2⁶)

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
