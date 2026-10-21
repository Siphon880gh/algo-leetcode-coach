## Pop as soon as you can

`stack = []`, `j = 0`. For each `x` in `pushed`:

1. Push `x`.
2. While the stack is non-empty and `stack[-1] == popped[j]`: pop, `j += 1`.

Return `j == n` (or the stack is empty).

Popping greedily is safe because values are distinct: if the top matches the next pop now, waiting would bury it under later pushes and make that pop impossible.

Do not try to decide pushes and pops by search. Do not save all the pops for the end; pops interleave with pushes.

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
