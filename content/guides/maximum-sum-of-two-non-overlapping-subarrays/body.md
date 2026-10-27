## Two orders, one sweep each

Prefix sums `P` with `P[0] = 0`. For an order (left length `L`, right length `M`):

- `best = 0`. For `i` from `L + M` to `n`:
  - `best = max(best, P[i − M] − P[i − M − L])` (best `L`-window ending by `i − M`).
  - `ans = max(ans, best + P[i] − P[i − M])`.

Run it for `(firstLen, secondLen)` and `(secondLen, firstLen)`; return the larger result.

Do not try only one order; the longer window can sit on either side. Do not try every pair of windows; that is O(n²).

Time: O(n)  
Space: O(n)

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
