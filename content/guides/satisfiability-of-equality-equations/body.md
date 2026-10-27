## Two passes

Union-find over the 26 letters.

1. For each `"a==b"`, `union(a, b)`.
2. For each `"a!=b"`, if `find(a) == find(b)`, return false.

Return true.

All `==` must be applied first: an inequality can only be judged once every equality that might connect its variables is known.

`"a!=a"` is caught by the same check, since a letter is always in its own set.

Do not process equations in input order with a single pass. Do not build a graph and run DFS per inequality; union-find is simpler.

Time: O(n α(26))  
Space: O(26)

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
