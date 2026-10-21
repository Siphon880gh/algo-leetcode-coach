## Meet at the LCA

1. `ps` = path root → start, `pd` = path root → dest (letters L and R).
2. Strip the longest common prefix.
3. Answer = `U` × (remaining length of `ps`) + remaining `pd`.

Examples → `UURL`, `L`.

The common prefix is exactly the walk from the root to the lowest common ancestor. From start, every remaining step of `ps` is undone by going up, then `pd` leads down to dest. Use an iterative DFS or build paths with backtracking; recursion depth can reach n = 10^5.

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
