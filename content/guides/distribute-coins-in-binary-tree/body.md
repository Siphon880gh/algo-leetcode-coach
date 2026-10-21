## Moves equal edge traffic

`dfs(node)` returns the excess of its subtree:

- `None` → 0.
- `l = dfs(node.left)`, `r = dfs(node.right)`.
- `moves += |l| + |r|`.
- Return `node.val + l + r − 1`.

Return `moves` after `dfs(root)`.

A negative excess means coins must come in; a positive one means coins go out. Either way, `|excess|` coins cross that edge, and each crossing is one move.

Do not simulate moving coins one at a time. Do not forget the `− 1`: each node keeps one coin.

Time: O(n)  
Space: O(h)

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
