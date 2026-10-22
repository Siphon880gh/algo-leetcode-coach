Open windows are listed from top to bottom. Each query brings one window to the top. Return the order after all queries. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Last touch wins

1. Walk queries from the end; append a window the first time you see it.
2. Append the windows never queried, in their original order.

Constructed checks (run in code): [1, 2, 3] with queries 3, 3, 2 → [2, 3, 1]; [4, 1, 3, 2] with 2, 4, 2 → [2, 4, 1, 3]. Checked against direct simulation on 300 random cases.

Walking the queries forwards: [1, 2, 3] with 2, 3 → [2, 3, 1] instead of [3, 2, 1].

Time: O(n + q)  
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
