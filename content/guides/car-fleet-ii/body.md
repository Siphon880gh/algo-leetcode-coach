## Who do I hit first?

For car `i` from the right:

1. While the stack top `j` has `speed[i] ≤ speed[j]`, or `ans[j] > 0` and `(pos[j] − pos[i]) / (speed[i] − speed[j]) ≥ ans[j]`: pop.
2. If the stack is non-empty, `ans[i] = (pos[top] − pos[i]) / (speed[i] − speed[top])`.
3. Push `i`.

Example 1 → `[1,-1,3,-1]`. Example 2 → `[2,1,1.5,-1]`.

Popping is safe: once `j` merges into a slower fleet, any later catch of that spot is a catch of the car `j` merged with, which is deeper in the stack.

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
