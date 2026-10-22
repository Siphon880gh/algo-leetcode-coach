## Trade duplicates

1. Sort by profit descending; take the first k, putting items whose category was already taken on a stack.
2. For each later item of a new category, while the stack is nonempty: swap it in for the top of the stack (the cheapest duplicate), and add its category.
3. Track `total + distinct²` after each step.

Examples → 17, 19, 7. Checked against trying every subset of size k on 400 random small inputs.

Stopping at the top k by profit misses the category bonus: example 2 → 15 instead of 19. Profit sums reach 10^14, so use 64-bit.

Time: O(n log n)  
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
