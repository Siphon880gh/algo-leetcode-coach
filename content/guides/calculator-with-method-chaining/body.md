## Fluent class

1. Constructor stores the value.
2. add, subtract, multiply, power (`**`): update and `return this`.
3. divide: if the value is 0, throw `new Error('Division by zero is not allowed')`; else divide and `return this`.
4. getResult returns the value.

Examples → 8, 100, Division by zero is not allowed. Checked in Node.

Forgetting `return this` breaks the chain: in Node the second call → a TypeError. Check for 0 explicitly, since JavaScript gives 20 / 0 = Infinity instead of an error.

Time: O(1) per call  
Space: O(1)

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
