`ring` and `key` have 1 to 100 lowercase letters, and `key` can always be spelled. `ring[0]` starts at 12:00. Each one-position rotation (either way) costs 1, and pressing to spell the aligned character costs 1. Return the minimum total steps. `"godding"`, `"gd"` → 4. `"godding"`, `"godding"` → 13.

## State = which key char, which ring position

Precompute `pos[c]`, the ring indexes holding `c`. Let `f[i][j]` be the fewest steps to spell `key[0..i]` ending with `ring[j]` at the top (`ring[j] == key[i]`).

- First char: `f[0][j] = min(j, n − j) + 1` for `j` in `pos[key[0]]`.
- Then `f[i][j] = min over k in pos[key[i − 1]] of f[i − 1][k] + min(|j − k|, n − |j − k|) + 1`.

The answer is `min f[m − 1][j]`. Rotation distance on a circle is the shorter way around.

Greedy (always rotate to the nearest copy of the next char) can lose: a near copy may leave you far from the char after it. The DP compares every copy.

Do not forget the press step (`+ 1` per key char), or the wrap-around distance `n − |j − k|`.

Time: O(m · n²) worst case  
Space: O(m · n), or O(n) with rolling rows

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
