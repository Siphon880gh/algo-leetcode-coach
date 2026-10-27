## Where the largest value goes

`f[i][j]` = permutations of `1..i` with exactly `j` inverse pairs. Insert `i` into a permutation of `1..i−1`: putting it `t` places from the end creates exactly `t` new pairs, for `t` from 0 to `i − 1`. So

`f[i][j] = Σ f[i−1][j − t]` for `t = 0 .. min(j, i − 1)`.

That sum is a sliding window over the previous row:

`f[i][j] = f[i][j − 1] + f[i−1][j] − f[i−1][j − i]` (drop the last term when `j − i < 0`).

Start with `f[0][0] = 1` (or `f[1][0] = 1`). Take everything modulo `1e9 + 7`, and add the modulus before reducing a difference so it never goes negative.

Do not loop over `t` inside each cell; that is O(n · k · n). Do not forget the modular fix after the subtraction.

Time: O(n · k)  
Space: O(k) with two rows

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
