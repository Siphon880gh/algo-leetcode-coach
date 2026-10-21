## Components are free to permute

1. DSU over indices; union each pair.
2. Group indices by root.
3. For each group: sort the indices, sort their letters, and assign the smallest letter to the smallest index.

`"dcab"`, `[[0,3],[1,2]]` → `"bacd"`. Adding `[0,2]` connects everything → `"abcd"`.

Do not greedily apply swaps that improve the string; the order of swaps does not matter, only connectivity. Do not sort the whole string; letters cannot leave their component.

Time: O(n log n + p · α(n))  
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
