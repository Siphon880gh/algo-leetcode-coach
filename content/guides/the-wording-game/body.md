Alice and Bob each hold a sorted list of distinct words and take turns playing words, Alice first. Each word played must be related to the previous one by the rules in the official statement, and a player who cannot play loses. Return whether Alice wins when both play optimally. The exact rules and limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Game DP

This assumes: Alice opens with her lexicographically smallest word; each reply must be lexicographically greater than the last word and start with the same letter or the next one; a player who cannot move loses. Adapt the reply range if the statement differs.

1. After a word x, the replies are the opponent’s words greater than x starting with x’s letter or the next: one contiguous block of their sorted list.
2. Go through all words from largest to smallest; x is a winning play if the opponent’s block holds no winning play (suffix counts make this O(1)).
3. Return whether Alice’s opening word is a winning play.

Constructed checks (run in code): [apple, cat] vs [banana] → true; [ant] vs [art] → false; [ant, bee] vs [art] → true; 3000 random games match a full game search.

Simple rules such as always playing the largest, or the smallest, valid word each disagreed with the search on random games.

Time: O((n + m) log(n + m))  
Space: O(n + m)

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
