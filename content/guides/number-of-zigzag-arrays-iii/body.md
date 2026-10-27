You get integers n, l and r. Count the arrays of length n with every value in [l, r], no two neighbors equal, and no three consecutive values strictly increasing or strictly decreasing. Return the count modulo 10^9 + 7. Here the value range can be far larger than n. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Small m, then interpolate

1. f(m) by DP: up[v], down[v] = arrays ending at v after a rise or a fall; each step uses prefix sums.
2. Compute f(0), f(1), …, f(n).
3. Return the Lagrange interpolation at m mod 10^9 + 7.

Assumed here: the same zigzag rules as versions I and II, with n small and the value range possibly huge.

Constructed checks (made-up values, run in code): n = 4 with 4 values → 62; with 10 values → 3,390. The DP matched listing every array for n ≤ 6, and interpolation matched the DP up to 39 values for n ≤ 12.

Interpolating from only n points: the second check → 1,290 instead of 3,390.

Time: O(n³)  
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
