## Test candidates in order

1. For `x` from `n + 1` upward: count digits; return `x` if every digit `d` present occurs exactly `d` times (so 0 never appears).

Examples → 22, 1333, 3133.

The largest answer needed is 1224444 (for n just below it), so the scan is at most about 10^6 checks of 7 digits. Faster: generate all balanced numbers up to 7 digits by choosing digit multisets and permuting, then binary search.

Time: O(A · d) with A the gap to the answer  
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
