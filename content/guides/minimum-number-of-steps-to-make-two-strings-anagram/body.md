## One-sided difference

1. `cnt[c] += 1` for `c` in `s`, `cnt[c] −= 1` for `c` in `t`.
2. Return the sum of the positive entries.

`"bab"`, `"aba"` → 1. `"leetcode"`, `"practice"` → 5. `"anagram"`, `"mangaar"` → 0.

Do not sum absolute differences; that counts each replacement twice. Do not sort and compare positions; anagrams ignore order.

Time: O(n)  
Space: O(26)

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
