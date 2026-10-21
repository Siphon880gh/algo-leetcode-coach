## Only counts matter

1. `c[0]`, `c[1]` = students preferring each type.
2. For each sandwich `s` from the top: if `c[s] == 0`, return remaining sandwiches; else `c[s] −= 1`.
3. Return 0.

`[1,1,0,0]`, `[0,1,0,1]` → 0. `[1,1,1,0,0,1]`, `[1,0,0,0,1,1]` → 3.

A literal queue simulation also passes for n ≤ 100, but needs a stop rule for a full rotation without eating.

Time: O(n)  
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
