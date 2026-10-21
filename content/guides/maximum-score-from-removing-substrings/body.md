## Two stack passes

1. Let the first pair be the one with the larger score.
2. Stack pass: push characters; when the top and current form the first pair, pop and add its score.
3. Repeat on the leftover string for the second pair.

`"cdbcbbaaabab"`, 4, 5 → 19. `"aabbaaxybbaabb"`, 5, 4 → 20.

Taking every high-value pair first never reduces the total; each removal of either pair uses one a and one b. Other letters split segments naturally since they never pair.

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
