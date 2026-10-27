## One map for both lists

1. `w[v] += weight` for every `[v, weight]` in `items1` and `items2`.
2. Return `[v, w[v]]` for `v` in ascending order.

Examples → [[1,6],[3,9],[4,5]], [[1,4],[2,4],[3,4]], [[1,7],[2,4],[7,1]].

Values are unique within each list, so a value appears at most twice. Values are at most 1000, so an array of counts scanned in order avoids the sort.

Time: O((n + m) log(n + m))  
Space: O(n + m)

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
