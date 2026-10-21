## Push mass forward

`dp[r][c]` is the probability the knight is on `(r, c)` and still on the board. Start with 1 at `(row, column)`.

Repeat `k` times: build a fresh board. For each cell with mass `p`, and each of the 8 knight moves landing on the board, add `p / 8` there. Moves that leave the board just lose that mass.

The answer is the sum of the final board.

The same idea works top-down: `f(m, r, c)` is the probability of surviving `m` more moves from `(r, c)`, the average of `f(m − 1, ·)` over the 8 moves, with off-board moves counting as 0. Memoize it.

Do not simulate random walks; the answer must be exact to about 1e-5. Do not update the board in place; that mixes step `m` and step `m + 1`.

Time: O(k · n²)  
Space: O(n²)

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
