## Only suffixes merge

In the encoding `"time#bell#"`, the word `"me"` is free because it ends at the same `#` as `"time"`. A word can be absorbed only if it is a suffix of another word.

1. `S = set(words)`.
2. For each word, remove `word[k:]` for every `k ≥ 1` from `S`.
3. Return `Σ (len(w) + 1)` over `w` in `S`.

Words have at most 7 letters, so step 2 is cheap.

**Trie alternative:** insert the reversed words into a trie; the answer counts the leaves, each contributing its depth + 1.

Do not remove prefixes; `"time"` and `"tim"` cannot share. Do not forget the `#` after every kept word.

Time: O(Σ len²)  
Space: O(Σ len)

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
