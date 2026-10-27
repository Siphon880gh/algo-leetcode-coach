## Three candidates

1. p[j] for every adjacent pair.
2. pre[t] = max p[0 … t − 1]; suf[t] = max p[t …].
3. ans[i] = max(pre[i − 1], suf[i + 1], lcp(words[i − 1], words[i + 1]) if both exist), with empty ranges as 0.

Examples → [3, 0, 0, 3, 3], [0, 0, 0]. Checked against rebuilding the array for every removal on 1,000 random cases.

Forgetting the new pair: ["a", "b", "a"] → [0, 0, 0] instead of [0, 1, 0].

Time: O(total length)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
