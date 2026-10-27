## Squeeze from both ends

Set `a = 0`, `b = isqrt(c)`. While `a ≤ b`:

- `s = a² + b²`. If `s == c`, return true.
- If `s < c`, `a += 1`; otherwise `b −= 1`.

Return false when they cross. Every step rules out one value for good, so there are at most √c steps. Use 64-bit arithmetic, since `b²` can approach `2³¹`.

Another way: for each `a`, check whether `c − a²` is a perfect square with `isqrt`. Fermat's theorem gives a math test too: `c` is a sum of two squares iff every prime of the form `4k + 3` appears to an even power.

Do not start `b` at `c`; that is √c times more work. Do not forget `a = b` (for example `2 = 1² + 1²`) or `a = 0` (`4 = 0² + 2²`).

Time: O(√c)  
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
