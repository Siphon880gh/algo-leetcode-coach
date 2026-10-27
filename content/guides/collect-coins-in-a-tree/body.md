## Peel the tree

1. Repeatedly remove leaves with no coin (a queue of degree-1 coinless nodes).
2. Remove all current leaves, twice (two rounds, not repeatedly).
3. With `m` nodes left, return `2(m − 1)` if `m > 1`, else 0.

Examples → 2, 2. Checked against trying every connected set of nodes as the walk on 300 random trees.

A closed walk crosses each used edge twice. After step 1, every leaf holds a coin, and the walk only has to come within 2 edges of it.

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
