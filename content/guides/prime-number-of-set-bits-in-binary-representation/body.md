## Popcount, then a lookup

For each `x` from `left` to `right`, compute `popcount(x)` (built in, or `x &= x − 1` in a loop), and count it if it is in `{2, 3, 5, 7, 11, 13, 17, 19}`.

The set can also be a bitmask: `665772` has bits 2, 3, 5, 7, 11, 13, 17, 19 set, so `(665772 >> popcount(x)) & 1` tests primality in one step.

The range is at most 10⁴ numbers, so a loop is the intended solution.

Do not run a general primality test per number; the popcount is tiny. Do not forget that 1 is not prime.

Time: O(right − left)  
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
