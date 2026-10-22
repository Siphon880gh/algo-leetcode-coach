## Reparent, then size

1. DFS from 0 with 26 stacks; new_parent[x] = top of stack[s[x]] if non-empty; push x for its subtree, pop after.
2. Subtree sizes by post-order on new_parent.

Examples → [6, 3, 1, 1, 1, 1], [5, 2, 1, 1, 1].

Using the farthest same-letter ancestor: parent [−1, 0, 1, 2], s = aaaa → [4, 1, 1, 1] instead of [4, 3, 2, 1].

Time: O(n)  
Space: O(n)

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
