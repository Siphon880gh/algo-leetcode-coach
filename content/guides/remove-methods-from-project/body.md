## Reach and verify

1. DFS from k over invocations; mark suspicious.
2. If some edge a → b has a unmarked and b marked, return all methods.
3. Else return the unmarked ones.

Examples → [0, 1, 2, 3], [3, 4], [].

Marking only k and its direct callees: n = 3, k = 0, invocations [[0, 1], [1, 2]] → [2] instead of [].

Time: O(n + e)  
Space: O(n + e)

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
