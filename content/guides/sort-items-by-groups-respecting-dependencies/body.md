## Order groups, then items

1. For each item with `group[i] == −1`, assign a fresh group id `m, m + 1, …`.
2. For each dependency `b → i`: if the groups differ, add the edge `group[b] → group[i]`; otherwise add `b → i` inside that group.
3. Kahn's algorithm on the groups. Then, for each group in that order, Kahn on its items and append them.
4. If either sort leaves nodes unvisited, return `[]`.

Example 1 has a valid answer such as `[6,3,4,1,5,2,0,7]`; example 2 has a cycle and returns `[]`.

Do not run one topological sort over items alone; a group's items must be contiguous. Do not leave ungrouped items in a shared −1 group; they must not be forced together.

Time: O(n + m + E)  
Space: O(n + m + E)

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
