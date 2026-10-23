Given an array of words, pick two indices i < j whose words differ and make the span j − i + 1 (both ends counted) as large as possible. Return that span, or 0 if every word is the same. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two scans

1. best = 0.
2. For each j with words[j] ≠ words[0]: best = max(best, j + 1).
3. For each i with words[i] ≠ words[n − 1]: best = max(best, n − i).
4. Return best.

Constructed checks (run in code): ["a", "a", "b"] → 3; ["a", "b", "a"] → 2; ["c", "c"] → 0. Checked against testing every pair on 3,000 random arrays.

Checking only the pair (0, n − 1): ["a", "b", "a"] → 0 instead of 2.

Time: O(n · L), L = word length  
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
