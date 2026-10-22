## O(n k)

1. For x in order, for j = k … 0: row[x][j] = max(row[x][j] + 1, best[j − 1] + 1 if j ≥ 1); best[j] = max(best[j], row[x][j]).
2. Answer: best[k].

Examples → 4, 2. Checked against version I and every subsequence on 400 random arrays.

Version I’s O(n² k) is about 1.3 · 10^9 steps at n = 5,000, k = 50. Go from k down so best[j − 1] is still from earlier elements.

Time: O(n k)  
Space: O(n k)

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
