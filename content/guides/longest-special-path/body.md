## Window start per node

1. DFS from 0 with dist[depth] and last[value] = depth of the deepest node on the path with that value.
2. At node u at depth d: top = max(parent’s top, last[nums[u]] + 1). Length = dist[d] − dist[top]; nodes = d − top + 1. Keep the longest, then fewest nodes.
3. Set last[nums[u]] = d for the children; restore it on the way back.

Examples → [6, 2], [0, 1]. Checked against every downward path on 800 random trees. Use an explicit stack for depth up to 5 · 10^4.

Setting top = last + 1 without keeping the larger start: edges [[0, 1, 2], [1, 2, 5], [2, 3, 3], [0, 4, 1]], nums = [0, 3, 0, 2, 3] → [10, 4] instead of [8, 3].

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
