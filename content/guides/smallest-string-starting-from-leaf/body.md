## Build, then compare at leaves

`dfs(node, path)`:

1. Append `chr(97 + node.val)` to `path`.
2. If `node` is a leaf, compare `reversed(path)` with `best` and keep the smaller.
3. Recurse into the children.
4. Remove the last letter (backtrack).

Return `best`.

Why not greedy: at a node, the smaller child letter does not guarantee a smaller result, because the strings are read from the leaf, and their lengths differ (a shorter string that is a prefix is smaller).

Do not pick children by their letter alone. Do not compare root-to-leaf strings; the answer reads from the leaf up.

Time: O(n · h) for the string comparisons  
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
