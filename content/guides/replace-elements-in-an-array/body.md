## Move the index with the value

1. `pos[v] = i` for every `nums[i]`.
2. For `[x, y]`: `i = pos[x]`; delete `pos[x]`; `nums[i] = y`; `pos[y] = i`.
3. Return `nums`.

Examples → [3,2,7,1], [2,1].

Searching the array for x each time is O(n · m), up to 10^10. Example 2 reuses 1 after it was replaced, which is why the old key must be removed or overwritten correctly.

Time: O(n + m)  
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
