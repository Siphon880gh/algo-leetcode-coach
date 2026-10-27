## Search down from the square root

Factor pairs `(W, area / W)` get closer together as `W` approaches `sqrt(area)` from below. So the best `W` is the largest divisor of `area` that is at most `sqrt(area)`. Set `W = floor(sqrt(area))` (fix it up with integer checks if the float root is off by one), and decrease `W` until `area % W == 0`. `W = 1` always works, so the loop ends. Return `[area / W, W]`.

Valid Perfect Square (367) and Sqrt(x) (69) compute the root itself. Count Primes (204) and other divisor problems also loop only up to `sqrt(n)`.

Do not search upward from 1 and keep the last divisor — it works but scans more. Do not return `[W, L]` — length comes first and must be the larger side.

Time: O(sqrt(area))  
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
