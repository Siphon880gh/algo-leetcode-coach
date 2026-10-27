## Three checks

1. Count in-degrees from both child arrays; any node with in-degree 2 → false.
2. Exactly one node with in-degree 0 is the root; otherwise false.
3. BFS from the root; return true only if it visits all `n` nodes.

`n = 4`, left `[1,-1,3,-1]`, right `[2,-1,-1,-1]` → true. With right `[2,3,-1,-1]` → false (node 3 has two parents). `n = 2`, left `[1,0]` → false (a cycle, no root).

Do not stop after the in-degree checks; a separate cycle can still exist. Do not assume node 0 is the root.

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
